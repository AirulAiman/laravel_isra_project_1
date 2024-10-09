<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="create-threat-group">Create</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
        <div class="d-flex justify-content-center align-items-center">
            <div class="container text-center">
                <div class="btn-group" role="group">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            @if ($groupies->isEmpty())
                                <button class="nav-link active" id="nav-group-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-group" type="button" role="tab" aria-controls="nav-group"
                                    aria-selected="true">
                                    Group
                                </button>
                                <button class="nav-link disabled" id="nav-threat-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-threat" type="button" role="tab"
                                    aria-controls="nav-threat" aria-selected="false">
                                    Threat
                                </button>
                            @else
                                <button class="nav-link active" id="nav-group-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-group" type="button" role="tab" aria-controls="nav-group"
                                    aria-selected="true">
                                    Group
                                </button>
                                <button class="nav-link" id="nav-threat-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-threat" type="button" role="tab"
                                    aria-controls="nav-threat" aria-selected="false">
                                    Threat
                                </button>
                            @endif
                        </div>
                    </nav>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center align-items-center my-3">
            <div class="tab-content" id="nav-tabContent">

                {{-- CREATE GROUP FORM --}}
                <div class="tab-pane fade show active" id="nav-group" role="tabpanel" aria-labelledby="nav-group-tab"
                    tabindex="0">
                    <form id="form-create-group" action="{{ route('threat-groups.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mt-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
                            <input type="text" class="form-control" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" id="name" name="name" required>
                        </div>
                    </form>
                </div>

                {{-- CREATE THREATS FORM --}}
                <div class="tab-pane fade" id="nav-threat" role="tabpanel" aria-labelledby="nav-threat-tab"
                    tabindex="0">
                    <form id="form-create-threat" action="{{ route('threats.store') }}" method="POST">
                        @csrf
                        <div class="input-group mt-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
                            <input type="text" class="form-control" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" id="name" name="name" required>

                        </div>
                        <div class="input-group mt-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Description</span>
                            <textarea type="text" class="form-control" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" id="description" name="description" required>
                            </textarea>

                        </div>
                        <div class="input-group mt-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Threat Group</span>
                            <select class="form-select" aria-label="Default select example" id="threat_group_id"
                                name="threat_group_id" required>
                                <option selected>Choose...</option>
                                @foreach ($groupies as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- SUBMIT BUTTON --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="submit-group" form="form-create-group">Create</button>
        <button type="submit" class="btn btn-primary" id="submit-threat" form="form-create-threat">Create</button>
    </div>

    <script>
        const groupTab = document.getElementById('nav-group-tab');
        const threatTab = document.getElementById('nav-threat-tab');

        const groupBtn = document.getElementById('submit-group');
        const threatBtn = document.getElementById('submit-threat');

        groupBtn.style.display = 'none';
        threatBtn.style.display = 'none';

        function showGroupBtn() {
            groupBtn.style.display = 'block';
            threatBtn.style.display = 'none'; 
        }

        function showThreatBtn() {
            groupBtn.style.display = 'none';
            threatBtn.style.display = 'block';
        }

        if (groupTab.classList.contains('active')) {
            showGroupBtn();
        } else if (threatTab.classList.contains('active')) {
            showThreatBtn();
        }

        document.getElementById('nav-tab').addEventListener('click', function(event) {
            if (event.target.id === 'nav-group-tab') {
                showGroupBtn();
            } else if (event.target.id === 'nav-threat-tab') {
                showThreatBtn();
            }
        });

        // reroute to ''
    </script>
</div>
