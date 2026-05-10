@php
    $gallery = $getState();

    if (is_string($gallery)) {
        $gallery = array_filter(array_map('trim', explode(',', $gallery)));
    }

    if (!is_array($gallery) || empty($gallery)) {
        echo '<p style="color:#9ca3af;">No images</p>';
        return;
    }
@endphp

<div class="fi-in-entry-label" role="term">Gallery</div>
<div style="display:flex;flex-wrap:wrap;gap:10px;align-items:flex-start;">
    @foreach($gallery as $imagePath)
        @php
            $imagePath = trim($imagePath);
            if (empty($imagePath)) continue;
            $url = \Illuminate\Support\Facades\Storage::disk('public')->url($imagePath);
        @endphp

        <div style="width:100px;height:100px;overflow:hidden;border-radius:12px;border:1px solid #e5e7eb;background:#f9fafb;box-shadow:0 1px 2px rgba(0,0,0,0.08);">
            <img src="{{ $url }}" loading="lazy" style="width:100%;height:100%;object-fit:cover;display:block;" alt="Gallery">
        </div>
    @endforeach
</div>
