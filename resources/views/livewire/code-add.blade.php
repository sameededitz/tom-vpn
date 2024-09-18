<div>
    <button type="button" class="btn rounded-pill btn-outline-info-600 radius-8 px-20 py-11" data-bs-toggle="modal"
        data-bs-target="#addCode">Add Codes</button>

    <div wire:ignore.self class="modal fade" id="addCode" tabindex="-1" aria-labelledby="addCode" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCodeLabel">Generate Promo Codes
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="py-2">
                            @foreach ($errors->all() as $error)
                                <x-alert type="danger" :message="$error" />
                            @endforeach
                        </div>
                    @endif
                    <div class="py-2 d-none alert alert-success fs-5" id="success-text"></div>
                    <form wire:submit.prevent="submit">
                        <div class="row gy-3">
                            <div class="col-12">
                                <label class="form-label">Select Plan</label>
                                <select name="plan_id" class="form-select" wire:model="plan_id">
                                    <option selected>Select Plan</option>
                                    @foreach ($plans as $plan)
                                        <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Number Of Codes</label>
                                <input type="number" wire:model.blur="quantity" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Expires After Number of Days (Enter Days Count only)</label>
                                <input type="number" wire:model.blur="expires_at" class="form-control">
                                <small>Ex. 2, The Codes will gonna Expire After 2 days</small>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary-600">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@script
    <script>
        $wire.on('code-add', () => {
            // Show the success message
            const alertmsg = document.querySelector('#success-text');
            console.log(alertmsg);
            alertmsg.classList.remove('d-none');
            alertmsg.textContent =
                'Promo codes added successfully!'; // Update the success message text if needed

            // Close the Bootstrap modal after 2 seconds
            setTimeout(function() {
                var modal = bootstrap.Modal.getInstance(document.querySelector('#addCode'));
                modal.hide();
            }, 2000);
        })
    </script>
@endscript
