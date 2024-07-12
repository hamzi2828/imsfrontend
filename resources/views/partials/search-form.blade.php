<form method="get" action="{{ route ('products.index') }}"
      class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper">
    <div class="select-box">
        <label for="category"></label>
        <select id="category" name="category">
            <option value="">All Categories</option>
            @if(count ($categories) > 0)
                @foreach($categories as $category)
                    <option value="{{ $category -> slug }}" @selected(request ('category') == $category -> slug)>
                        {{ $category -> title }}
                    </option>
                @endforeach
            @endif
        </select>
    </div>
    <label for="search"></label>
    <input type="text" class="form-control" name="search" id="search" placeholder="Search in..."
           required="required" value="{{ request ('search') }}" />
    <button class="btn btn-search" type="submit"><i class="w-icon-search"></i></button>
</form>