@if($errors -> any())
    @foreach($errors -> all() as $error)
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Error!</h4>
            <div class="alert-body">
                {{ $error }}
            </div>
        </div>
    @endforeach
@endif

@if(session () -> has ('error'))
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Error!</h4>
        <div class="alert-body">
            {{ session ('error') }}
        </div>
    </div>
@endif

@if(session () -> has ('status'))
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Success!</h4>
        <div class="alert-body">
            {{ session ('status') }}
        </div>
    </div>
@endif

@if(session () -> has ('Invalidcouponcode'))


<div class="col-md-8 mb-4">
    <div class="alert alert-warning alert-button show-code-action">
        <a href="#" class="btn btn-warning btn-rounded">Alert</a>
        {{ session ('Invalidcouponcode') }}

    </div>

</div>


    {{-- <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Invalid coupon code!</h4>
        <div class="alert-body">
            {{ session ('Invalidcouponcode') }}
        </div>
    </div> --}}
@endif


@if(session () -> has ('review_submitted'))

<div class="col-md-8 mb-4">
    <div class="alert alert-success alert-button show-code-action">
        <a href="#" class="btn btn-success btn-rounded">Well Done</a>
        {{ session ('review_submitted') }}

    </div>
</div>
@endif


@if(session () -> has ('login_invalid'))

<div class="col-md-12 mb-4">
    @if(session('login_invalid'))
        <div class="alert alert-error alert-bg alert-button alert-block show-code-action">
            <h4 class="alert-title">Alert</h4>
            <p>{{ session('login_invalid') }}</p>
    
            <button class="btn btn-link btn-close" aria-label="button" onclick="this.closest('.alert').style.display='none';">
                <i class="fas fa-times"></i> <!-- Font Awesome cross icon -->
            </button>
        </div>
    @endif
</div>

@endif



{{-- <div class="col-md-6 mb-4">
    <div class="alert alert-success alert-button show-code-action">
        <a href="#" class="btn btn-success btn-rounded">Well Done</a>
        You successfully read this important alert message.
    </div>
</div>
<div class="col-md-6 mb-4">
    <div class="alert alert-warning alert-button show-code-action">
        <a href="#" class="btn btn-warning btn-rounded">Warning</a>
        Best check yourself, you're not looking too good.
    </div>
</div> --}}
