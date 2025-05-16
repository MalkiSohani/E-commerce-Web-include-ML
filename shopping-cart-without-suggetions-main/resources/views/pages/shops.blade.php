@extends('layouts.app')

@section('content')
    @include('layouts.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('layouts.navbar')
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                @include('layouts.flash')
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0 w-100" id="usersTable">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Name</th>
                                            <th
                                                class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Address</th>
                                            <th
                                                class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Owner</th>
                                            <th
                                                class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status</th>
                                            <th
                                                class="text-end text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($shops as $shop)
                                            <tr>
                                                <td class="text-xs text-secondary mb-0">{{ $shop->name }}</td>
                                                <td class="text-xs text-secondary mb-0">{{ $shop->address }}</td>
                                                <td class="text-xs text-secondary mb-0">
                                                    {{ $shop->ownerdata->name }}<br><small>{{ $shop->ownerdata->email }}</small>
                                                </td>
                                                <td class="text-xs text-secondary mb-0 text-left"><span
                                                        class="badge badge-sm bg-gradient-{{ (new App\Models\Colors())->getColor($shop['status']) }}">{{ App\Models\Shop::$status[$shop['status']] }}</span>
                                                </td>
                                                <td class="text-xs text-secondary mb-0 text-end">
                                                    <a target="_blank"
                                                        href="https://www.google.com/maps/search/?api=1&query={{ $shop->ltd }},{{ $shop->lng }}">
                                                        <i class="fa-solid fa-map mx-2 text-primary"></i></a>
                                                    <i onclick="doEdit({{ $shop->id }})"
                                                        class="fa-solid fa-pen-to-square mx-2 text-warning"></i>
                                                    <i onclick="doDelete({{ $shop->id }})"
                                                        class="fa-solid fa-trash mx-2 text-danger"></i>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-xs text-danger">No Data Found
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="row justify-content-end">
                                <div class="mt-4">
                                    {{ $shops->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <form autocomplete="off" action="{{ route('admin.shops.enroll') }}" method="POST"
                        id="enrollment_form">
                        @csrf
                        <input type="hidden" id="isnew" name="isnew"
                            value="{{ old('isnew') ? old('isnew') : '1' }}">
                        <input type="hidden" id="record" name="record"
                            value="{{ old('record') ? old('record') : '' }}">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Add/Edit Shops</h5>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="owner"><small class="text-dark">
                                                            Owner{!! required_mark() !!}</small></label>
                                                    <input value="{{ old('owner') }}" type="text" name="owner"
                                                        id="owner" class="form-control">
                                                    @error('owner')
                                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mt-1">
                                                    <label for="name"><small class="text-dark">
                                                            Name{!! required_mark() !!}</small></label>
                                                    <input value="{{ old('name') }}" type="text" name="name"
                                                        id="name" class="form-control">
                                                    @error('name')
                                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col-md-12">
                                                    <label for="address"><small class="text-dark">
                                                            Address{!! required_mark() !!}</small></label>
                                                    <textarea class="form-control" name="address" id="address" cols="30" rows="5">{{ old('address') }}</textarea>
                                                    @error('address')
                                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col-md-12">
                                                    <label for="tel"><small class="text-dark">
                                                            Tel</small></label>
                                                    <input value="{{ old('tel') }}" type="text" name="tel"
                                                        id="tel" class="form-control">
                                                    @error('tel')
                                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col-md-12">
                                                    <label for="lng"><small class="text-dark">
                                                            Longitude{!! required_mark() !!}</small></label>
                                                    <input value="{{ old('lng') }}" type="text" name="lng"
                                                        id="lng" class="form-control">
                                                    @error('lng')
                                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col-md-12">
                                                    <label for="ltd"><small class="text-dark">
                                                            Latitude{!! required_mark() !!}</small></label>
                                                    <input value="{{ old('ltd') }}" type="text" name="ltd"
                                                        id="ltd" class="form-control">
                                                    @error('ltd')
                                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col-md-12">
                                                    <label for="description"><small class="text-dark">
                                                            Any Other Informations</small></label>
                                                    <textarea class="form-control" name="description" id="description" cols="30" rows="5">{{ old('informations') }}</textarea>
                                                    @error('description')
                                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col-md-12">
                                                    <label for="status"><small class="text-dark">
                                                            Status</small></label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="1">Active</option>
                                                        <option value="2">Inactive</option>
                                                    </select>
                                                    @error('status')
                                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <hr class="my-2">
                                            <div class="row">
                                                <div class="col-md-6"> <input id="submitbtn"
                                                        class="btn bg-gradient-success w-100" type="submit"
                                                        value="Submit">
                                                </div>
                                                <div class="col-md-6 mt-md-0 mt-1"><input
                                                        class="btn bg-gradient-danger w-100" type="button"
                                                        form="enrollment_form" id="resetbtn" value="Reset">
                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @include('layouts.footer2')
        </div>
    </main>

    <script>
        function doEdit(id) {
            showAlert('Are you sure to edit this record ?', function() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.shops.get.one') }}",
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        $('#name').val(response.name);
                        $('#owner').val(response.owner);
                        $('#owner').attr('disabled', true);
                        $('#address').val(response.address);
                        $('#tel').val(response.tel);
                        $('#lng').val(response.lng);
                        $('#ltd').val(response.ltd);
                        $('#description').val(response.description);
                        $('#isnew').val('2').trigger('change');
                        $('#record').val(response.id);
                        $('#status').val(response.status);
                    }
                });
            });
        }

        function doDelete(id) {
            showAlert('Are you sure to delete this record ?', function() {
                window.location = "{{ route('admin.shops.delete.one') }}?id=" + id;
            });
        }

        @if (old('record'))
            $('#record').val({{ old('record') }});
        @endif

        @if (old('isnew'))
            $('#isnew').val({{ old('isnew') }}).trigger('change');
        @endif
    </script>
@endsection
