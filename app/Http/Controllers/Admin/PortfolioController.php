<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::with('service')->orderBy('sort_order')->latest()->paginate(10);
        $services   = Service::orderBy('name')->get();

        return view('admin.portfolio.index', compact('portfolios', 'services'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'service_id'   => ['required', 'exists:services,id'],
            'title'        => ['required', 'string', 'max:255'],
            'slug'         => ['nullable', 'string', 'max:255', 'unique:portfolios,slug'],
            'client'       => ['nullable', 'string', 'max:255'],
            'location'     => ['nullable', 'string', 'max:255'],
            'published_at' => ['nullable', 'date'],
            'cover_image'  => ['nullable', 'image', 'max:5120'],
            'gallery.*'    => ['nullable', 'image', 'max:5120'],
            'excerpt'      => ['nullable', 'string'],
            'description'  => ['nullable', 'string'],
            'summary'      => ['nullable', 'string'],
            'challenge'    => ['nullable', 'string'],
            'solution'     => ['nullable', 'string'],
            'technologies' => ['nullable', 'string'],
            'features'     => ['nullable', 'string'],
            'tags'         => ['nullable', 'string'],
            'is_active'    => ['nullable', 'boolean'],
            'sort_order'   => ['nullable', 'integer'],
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('portfolio', 'public');
        }

        $gallery = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                if (count($gallery) >= 3) break;
                $gallery[] = $file->store('portfolio/gallery', 'public');
            }
        }

        $data['gallery']       = $gallery ?: null;
        $data['tags']          = $this->parseTags($data['tags'] ?? null);
        $data['technologies']  = $this->parseTags($request->input('technologies'));
        $data['features']      = $this->parseTags($request->input('features'));
        $data['slug']          = Str::slug($data['slug'] ?? $data['title']);
        $data['is_active']     = $request->boolean('is_active', true);
        $data['sort_order']    = $data['sort_order'] ?? 0;

        $portfolio = Portfolio::create($data);
        $portfolio->load('service');

        return response()->json([
            'success'   => true,
            'message'   => 'Portfolio item created.',
            'portfolio' => $this->formatForJs($portfolio),
        ]);
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $data = $request->validate([
            'service_id'          => ['required', 'exists:services,id'],
            'title'               => ['required', 'string', 'max:255'],
            'slug'                => ['nullable', 'string', 'max:255', 'unique:portfolios,slug,' . $portfolio->id],
            'client'              => ['nullable', 'string', 'max:255'],
            'location'            => ['nullable', 'string', 'max:255'],
            'published_at'        => ['nullable', 'date'],
            'cover_image'         => ['nullable', 'image', 'max:5120'],
            'gallery.*'           => ['nullable', 'image', 'max:5120'],
            'remove_gallery.*'    => ['nullable', 'string'],
            'excerpt'             => ['nullable', 'string'],
            'description'         => ['nullable', 'string'],
            'summary'             => ['nullable', 'string'],
            'challenge'           => ['nullable', 'string'],
            'solution'            => ['nullable', 'string'],
            'technologies'        => ['nullable', 'string'],
            'features'            => ['nullable', 'string'],
            'tags'                => ['nullable', 'string'],
            'is_active'           => ['nullable', 'boolean'],
            'sort_order'          => ['nullable', 'integer'],
        ]);

        if ($request->hasFile('cover_image')) {
            if ($portfolio->cover_image) {
                Storage::disk('public')->delete($portfolio->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('portfolio', 'public');
        }

        // Start with existing gallery, remove any flagged for deletion
        $existingGallery = $portfolio->gallery ?? [];
        $toRemove        = $request->input('remove_gallery', []);
        foreach ($toRemove as $path) {
            Storage::disk('public')->delete($path);
            $existingGallery = array_values(array_filter($existingGallery, fn($g) => $g !== $path));
        }

        // Append newly uploaded gallery images (cap total at 3)
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                if (count($existingGallery) >= 3) break;
                $existingGallery[] = $file->store('portfolio/gallery', 'public');
            }
        }

        $data['gallery']      = $existingGallery ?: null;
        $data['tags']         = $this->parseTags($data['tags'] ?? null);
        $data['technologies'] = $this->parseTags($request->input('technologies'));
        $data['features']     = $this->parseTags($request->input('features'));
        $data['slug']         = Str::slug($data['slug'] ?? $data['title']);
        $data['is_active']    = $request->boolean('is_active', true);
        $data['sort_order']   = $data['sort_order'] ?? 0;

        $portfolio->update($data);
        $portfolio->load('service');

        return response()->json([
            'success'   => true,
            'message'   => 'Portfolio item updated.',
            'portfolio' => $this->formatForJs($portfolio),
        ]);
    }

    public function toggleStatus(Portfolio $portfolio)
    {
        $portfolio->update(['is_active' => ! $portfolio->is_active]);

        return response()->json([
            'success'   => true,
            'is_active' => $portfolio->is_active,
            'message'   => $portfolio->is_active ? 'Portfolio item activated.' : 'Portfolio item deactivated.',
        ]);
    }

    public function destroy(Portfolio $portfolio)
    {
        if ($portfolio->cover_image) {
            Storage::disk('public')->delete($portfolio->cover_image);
        }
        foreach ($portfolio->gallery ?? [] as $path) {
            Storage::disk('public')->delete($path);
        }

        $portfolio->delete();

        return response()->json(['success' => true, 'message' => 'Portfolio item deleted.']);
    }

    // ── Helpers ──────────────────────────────────────────────────────────────

    private function parseTags(?string $raw): ?array
    {
        if (empty($raw)) return null;
        return array_values(array_filter(array_map('trim', explode(',', $raw))));
    }

    private function formatForJs(Portfolio $p): array
    {
        return [
            'id'           => $p->id,
            'title'        => $p->title,
            'slug'         => $p->slug,
            'client'       => $p->client,
            'location'     => $p->location,
            'published_at' => $p->published_at?->format('Y-m-d'),
            'published_fmt'=> $p->published_at?->format('M d, Y'),
            'cover_image'  => $p->cover_image ? asset('storage/' . $p->cover_image) : null,
            'gallery'      => collect($p->gallery ?? [])->map(fn($g) => [
                'path' => $g,
                'url'  => asset('storage/' . $g),
            ])->values()->all(),
            'excerpt'      => $p->excerpt,
            'description'  => $p->description,
            'summary'      => $p->summary,
            'challenge'    => $p->challenge,
            'solution'     => $p->solution,
            'tags'         => $p->tags ?? [],
            'tags_str'     => $p->tags ? implode(', ', $p->tags) : '',
            'technologies' => $p->technologies ?? [],
            'technologies_str' => $p->technologies ? implode(', ', $p->technologies) : '',
            'features'     => $p->features ?? [],
            'features_str' => $p->features ? implode(', ', $p->features) : '',
            'is_active'    => $p->is_active,
            'sort_order'   => $p->sort_order,
            'service_id'   => $p->service_id,
            'service_name' => $p->service->name ?? '—',
        ];
    }
}
