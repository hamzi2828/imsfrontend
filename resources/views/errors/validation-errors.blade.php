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
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Invalid coupon code!</h4>
        <div class="alert-body">
            {{ session ('Invalidcouponcode') }}
        </div>
    </div>
@endif
