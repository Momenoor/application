{{-- @if ($matter->isSubmitted())
    <div class="row">
        <div class="col-12">
            <div class="alert alert-dismissible border border-info bg-light-info d-flex flex-column flex-sm-row p-5 mb-10">
                <!--begin::Icon-->
                <span class="svg-icon svg-icon-2hx svg-icon-info me-4 mb-5 mb-sm-0"><svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path opacity="0.3"
                            d="M12 22C13.6569 22 15 20.6569 15 19C15 17.3431 13.6569 16 12 16C10.3431 16 9 17.3431 9 19C9 20.6569 10.3431 22 12 22Z"
                            fill="currentColor"></path>
                        <path
                            d="M19 15V18C19 18.6 18.6 19 18 19H6C5.4 19 5 18.6 5 18V15C6.1 15 7 14.1 7 13V10C7 7.6 8.7 5.6 11 5.1V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V5.1C15.3 5.6 17 7.6 17 10V13C17 14.1 17.9 15 19 15ZM11 10C11 9.4 11.4 9 12 9C12.6 9 13 8.6 13 8C13 7.4 12.6 7 12 7C10.3 7 9 8.3 9 10C9 10.6 9.4 11 10 11C10.6 11 11 10.6 11 10Z"
                            fill="currentColor"></path>
                    </svg></span>
                <!--end::Icon-->

                <!--begin::Wrapper-->
                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <!--begin::Title-->
                    <h4 class="fw-bold">{{__('app.alert')}}</h4>
                    <!--end::Title-->
                    <!--begin::Content-->
                    <span>{{__('app.you_cannot_edit_or_update_submitted_matter')}}.</span>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->

                <!--begin::Close-->
                <button type="button"
                    class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                    data-bs-dismiss="alert">
                    <span class="svg-icon svg-icon-1 svg-icon-info"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                fill="currentColor"></rect>
                        </svg></span>
                </button>
                <!--end::Close-->
            </div>
        </div>
    </div>
@endif --}}
<div class="card mb-5 mb-xl-10">
    <div class="card-header border-0 cursor-pointer">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{ __('app.matter-data') }}</h3>
        </div>
        <!--end::Card title-->
    </div>
    <div class="card-body pt-0">
        <form action="{{route('matter.update.basic-data',$matter)}}" method="POST">
            @csrf

            <div class="separator"></div>
            <div class="row pt-5">
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="fv-row -ml-1mb-5">
                                <label for="year"
                                       class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('app.year') }}</label>
                                <input type="text" name="year" id="year"
                                       class="@error('matter.year') is-invalid @enderror form-control form-control-solid"
                                       placeholder="{{__('app.year')}}" value="{{old('year',$matter->year)}}">
                                @error('year')
                                <div class="invalid-feedback fv-plugins-message-container">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="fv-row mb-5">
                                <label for="number"
                                       class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('app.number') }}</label>
                                <input id="number" type="text" name="number" value="{{old('number',$matter->number)}}"
                                       class="@error('matter.number') is-invalid @enderror form-control form-control-solid"
                                       placeholder="{{__('app.number')}}">
                                @error('number')
                                <div class="invalid-feedback fv-plugins-message-container">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row pt-5">
                        <div class="col-lg-4">
                            <label class="form-label fw-bolder fs-6 text-gray-700">{{ __('app.court') }}</label>
                            <!--end::Label-->
                            <!--begin::Select-->
                            <select name="court_id" aria-label="Select a court" data-control="select2"
                                    data-placeholder="{{__('app.select_a_court')}}" wire:model="matter.court_id"
                                    class="@error('matter.court_id') is-invalid @enderror form-select form-select-solid">
                                <option value=""></option>
                                @foreach ($courtsList as $court)
                                    <option
                                        @selected(old('court_id',$matter->court_id) == $court['id']) value="{{ $court['id'] }}">
                                        {{ $court['name'] }}</option>
                                @endforeach
                            </select>
                            @error('court_id')
                            <div class="invalid-feedback fv-plugins-message-container">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label class="form-label fw-bolder fs-6 text-gray-700">{{ __('app.level') }}</label>
                            <!--end::Label-->
                            <!--begin::Select-->
                            <select name="level_id" aria-label="{{__('app.select_a_level')}}" data-control="select2"
                                    data-placeholder="{{__('app.select_a_level')}}" wire:model="level_id"
                                    class="@error('level_id') is-invalid @enderror form-select form-select-solid">
                                <option value=""></option>
                                @foreach ($levelList as $level)
                                    <option
                                        @selected(old('level_id',$matter->level_id) == $level['id']) value="{{ $level['id'] }}">{{ __('app.'.$level['name']) }}</option>
                                @endforeach
                            </select>
                            @error('level_id')
                            <div class="invalid-feedback fv-plugins-message-container">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label class="form-label fw-bolder fs-6 text-gray-700">{{ __('app.type') }}</label>
                            <!--end::Label-->
                            <!--begin::Select-->
                            <select name="type_id" aria-label="{{__('app.select_a_type')}}" data-control="select2"
                                    data-placeholder="{{__('app.select_a_type')}}" wire:model="matter.type_id"
                                    class="@error('matter.type_id') is-invalid @enderror form-select form-select-solid">
                                <option value=""></option>
                                @foreach ($typesList as $type)
                                    <option
                                        @selected(old('type_id',$matter->type_id) == $type['id']) value="{{ $type['id'] }}">{{ $type['name'] }}</option>
                                @endforeach
                            </select>
                            @error('type_id')
                            <div class="invalid-feedback fv-plugins-message-container">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator separator-dashed my-10"></div>
            <div class="row mt-10">
                <div class="col-6">
                    <div class="row mb-10">
                        <label class="col-4 fw-bold text-muted">{{ __('app.commissioning') }}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-8">
                            <span class="fw-bolder fs-6 text-gray-800">{{ __('app.' . $matter->commissioning) }}</span>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-4 fw-bold text-muted">{{ __('app.status') }}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-8">
                        <span
                            class="fw-bolder fs-6 text-gray-800">{{ $matter->parent_id > 0 ? __('app.supplementary') : __('app.basic') }}</span>
                            @if ($matter->parent_id > 0)
                                @include('common.external-link', [
                                    'href' => route('matter.show', $matter->parent_id),
                                ])
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-5">
                <div class="col-lg-9">
                    <a class="btn btn-light-primary" href="{{route('matter.index')}}">{{__('app.cancel')}}</a>
                    <button class="btn btn-success">{{__('app.save')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>
