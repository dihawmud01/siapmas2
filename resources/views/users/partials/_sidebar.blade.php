<div class="col-lg-4">
    <div class="mb-3">
        <div class="section-title rounded-top mb-0">
            <h4 class="text-uppercase font-weight-bold m-0">{{ __('Berita Populer') }}</h4>
        </div>
        <div class="border-top-0 rounded-bottom border bg-white p-3">
            @foreach ($trending->take(3) as $news)
                <div class="d-flex align-items-center mb-3 rounded border bg-white" style="height: 120px">
                    @if ($news->img)
                        <img
                            class="img-fluid rounded-start"
                            src="{{ asset('storage/images/' . $news->img) }}"
                            alt=""
                            style="height: 100%; width: 200px; overflow: hidden; object-fit: cover"
                        />
                    @endif

                    <div class="w-100 h-100 d-flex flex-column justify-content-center border-left px-3">
                        <div class="mb-1">
                            <a
                                class="badge badge-primary text-uppercase font-weight-semi-bold text-decoration-none mr-2 p-2"
                                href="{{ route('categories', ['slug' => $news->category->slug]) }}"
                            >
                                {{ $news->category->title }}
                            </a>
                        </div>
                        <a
                            class="h6 text-dark font-weight-bold text-decoration-none mb-1"
                            href="{{ route('news.show', ['slug' => $news->slug]) }}"
                        >
                            {{ Str::limit($news->title, 40) }}
                        </a>
                        <p class="text-secondary" style="padding: 0; margin: 0" href="">
                            <small>{{ $news->views }} {{ __('Kali Dilihat') }}</small>
                        </p>
                    </div>
                </div>
            @endforeach

            <div class="mb-3">
                <div class="section-title rounded-top mb-0">
                    <h4 class="text-uppercase font-weight-bold m-0">{{ __('Kategori') }}</h4>
                </div>
                <div class="border-top-0 rounded-bottom border bg-white p-3">
                    <div class="d-flex m-n1 flex-wrap">
                        @foreach ($newsCategories as $category)
                            <a
                                href="{{ route('categories', ['slug' => $category->slug]) }}"
                                class="btn btn-sm text-uppercase btn-outline-secondary category-btn m-1 rounded"
                            >
                                {{ $category->title }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <div class="section-title rounded-top mb-0">
                    <h4 class="text-uppercase font-weight-bold m-0">{{ __('Tags') }}</h4>
                </div>
                <div class="border-top-0 rounded-bottom border bg-white p-3">
                    <div class="d-flex m-n1 flex-wrap">
                        @foreach ($tags as $tag)
                            <a
                                href="{{ route('tags', $tag->slug) }}"
                                class="btn btn-sm btn-outline-secondary category-btn m-1 rounded"
                            >
                                {{ $tag->title }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
