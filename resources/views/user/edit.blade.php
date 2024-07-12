<div class="tab-pane" id="account-details">
    <div class="icon-box icon-box-side icon-box-light">
        <span class="icon-box-icon icon-account mr-2">
            <i class="w-icon-user"></i>
        </span>
        <div class="icon-box-content">
            <h4 class="icon-box-title mb-0 ls-normal">Account Details</h4>
        </div>
    </div>
    <form class="form account-details-form" action="{{ route ('users.update', ['user' => auth () -> user () -> id]) }}"
          method="post">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="firstname">Name *</label>
                    <input type="text" id="firstname" name="name" placeholder="John" required="required"
                           class="form-control form-control-md" value="{{ old ('name', auth () -> user () -> name) }}">
                </div>
            </div>
            
            <div class="form-group mb-6 col-md-6">
                <label for="email_1">Email address *</label>
                <input type="email" id="email_1" name="email" required="required" readonly="readonly"
                       class="form-control form-control-md" value="{{ old ('email', auth () -> user () -> email) }}">
            </div>
            
            <div class="form-group mb-6 col-md-6">
                <label for="mobile">Mobile *</label>
                <input type="text" id="mobile" name="mobile" required="required"
                       class="form-control form-control-md" value="{{ old ('mobile', auth () -> user () -> mobile) }}">
            </div>
            
            <div class="form-group mb-6 col-md-6">
                <label for="dob">DOB *</label>
                <input type="date" id="dob" name="dob" required="required"
                       class="form-control form-control-md" value="{{ old ('dob', auth () -> user () -> dob) }}">
            </div>
            
            <h4 class="title title-password ls-25 font-weight-bold">Password change</h4>
            <div class="form-group col-md-6">
                <label class="text-dark" for="new-password">
                    New Password leave blank to leave unchanged
                </label>
                <input type="password" class="form-control form-control-md"
                       id="new-password" name="password">
            </div>
            
            <div class="form-group mb-6">
                <label for="address">Address *</label>
                <textarea id="address" name="address" required="required" rows="5"
                          class="form-control form-control-md">{{ old ('address', auth () -> user () -> address) }}</textarea>
            </div>
        </div>
        
        <button type="submit" class="btn btn-dark btn-rounded btn-sm mb-4">Save Changes</button>
    </form>
</div>