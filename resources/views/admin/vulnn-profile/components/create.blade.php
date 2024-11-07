<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="create-vuln-group">Create</h1>
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
                                <button class="nav-link disabled" id="nav-vuln-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-vuln" type="button" role="tab" aria-controls="nav-vuln"
                                    aria-selected="false">
                                    Vulnerability
                                </button>
                            @else
                                <button class="nav-link active" id="nav-group-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-group" type="button" role="tab" aria-controls="nav-group"
                                    aria-selected="true">
                                    Group
                                </button>
                                <button class="nav-link" id="nav-vuln-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-vuln" type="button" role="tab" aria-controls="nav-vuln"
                                    aria-selected="false">
                                    Vulnerability
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
                    <form id="form-create-group" action="{{ route('vulnerability-groups.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mt-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
                            <input type="text" class="form-control" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" id="name" name="name" required>
                        </div>
                    </form>
                </div>

                {{-- CREATE VULN FORM --}}
                <div class="tab-pane fade" id="nav-vuln" role="tabpanel" aria-labelledby="nav-vuln-tab" tabindex="0">
                    <form id="form-create-vuln" action="{{ route('vulnerabilities.store') }}" method="POST">
                        @csrf
                        <div class="input-group mt-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
                            <input type="text" class="form-control" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" id="name" name="name" required>

                        </div>
                        <div class="input-group mt-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Description</span>
                            <textarea type="text" class="form-control" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" id="description" name="description" required></textarea>

                        </div>
                        <div class="input-group mt-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Vulnerability Group</span>
                            <select class="form-select" aria-label="Default select example" id="vulnerability_group_id"
                                name="vulnerability_group_id" required>
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
        <button type="submit" class="btn btn-primary" id="submit-vuln" form="form-create-vuln">Create</button>
    </div>

    <script>
        const groupTab = document.getElementById('nav-group-tab');
        const vulnTab = document.getElementById('nav-vuln-tab');

        const groupBtn = document.getElementById('submit-group');
        const vulnBtn = document.getElementById('submit-vuln');

        groupBtn.style.display = 'none';
        vulnBtn.style.display = 'none';

        function showGroupBtn() {
            groupBtn.style.display = 'block';
            vulnBtn.style.display = 'none';
        }

        function showVulnBtn() {
            groupBtn.style.display = 'none';
            vulnBtn.style.display = 'block';
        }

        if (groupTab.classList.contains('active')) {
            showGroupBtn();
        } else if (vulnTab.classList.contains('active')) {
            showVulnBtn();
        }

        document.getElementById('nav-tab').addEventListener('click', function(event) {
            if (event.target.id === 'nav-group-tab') {
                showGroupBtn();
            } else if (event.target.id === 'nav-vuln-tab') {
                showVulnBtn();
            }
        });
    </script>
</div>
