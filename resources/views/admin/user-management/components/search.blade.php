<div class="align-items-center justify-content-center my-5">
    <form action="{{ route('user-management.index') }}" method="GET">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="text" class="form-control border-primary" placeholder="Search"
                        value="{{ request()->get('search') }}" name="search">
                    <button class="btn btn-primary" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
