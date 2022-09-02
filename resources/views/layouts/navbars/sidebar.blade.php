{{-- @php
    use App\Models\Building;

    $building = Building::get();
@endphp --}}

<div id="mySidepanel" class="sidepanel sidebar">
    
    {{-- <div class="sidebar-wrapper bg-dark" id="nav1">
        <div class="logo text-center">
            <a href="{{ route('main') }}" class="nav-link text-primary headeranimation">
                <img src="/black/img/logo.png" style="width: 200px" alt="E-Formula">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </a>
        </div>
        {{-- dynamic sidebar --}}
        {{-- @foreach ($building as $item)
        <div class="row">
            <div class="col-sm-10">
                <a class="btn btn-block lightbtn building text-light" href="{{route('building', $item->building_id)}}">
                    <i class="fas fa-building"></i>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    {{$item->building_name}}
                </a>
            </div>
            <div class="col-sm-1 p-0 text-left">
                <a class="btn clear-bg pl-0 icon-toggle lightbtn" data-toggle="collapse" href="#{{$item->building_name}}" role="button" aria-expanded="false" aria-controls="{{$item->building_name}}">
                    <i class="fa-solid fa-caret-down"></i>
                </a>
            </div>
        </div>
   
   
        <div class="collapse secondary-div" id="{{$item->building_name}}">
            @php
                $system = App\Models\System::where('building_id', $item->building_id)->get();
            @endphp
                @foreach ($system as $item_system)
                <div class="row">
                    <div class="col-sm-10">
                        <a class="btn btn-block btn-danger text-light lightbtn" href="{{route('system', $item_system->system_id)}}">
                            <i class="fal fa-sensor-smoke"></i>
                            {{$item_system->system_name}}
                        </a>
                    </div>
                    <div class="col-sm-1 p-0">
                        <a class="btn clear-bg pl-0 icon-toggle lightbtn" data-toggle="collapse" href="#{{$item_system->system_name}}" role="button" aria-expanded="false" aria-controls="{{$item_system->system_name}}">
                            <i class="fa-solid fa-caret-down"></i>
                        </a>
                    </div>
                </div>
                <div class="collapse tertiary-div" id="{{$item_system->system_name}}">
                    @php
                        $subsystem = App\Models\SubSystem::where('system_id', $item_system->system_id)->get();
                    @endphp
                    @foreach ($subsystem as $item_subsystem)
                    <div class="row">
                        <div class="col-sm-10">
                            <a class="btn-block btn lightbtn board" style="white-space: normal;" href="{{route('subsystem', $item_subsystem->id)}}">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                {{$item_subsystem->subsystem_name}}
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>             
                @endforeach
        </div>
        @endforeach
    </div> --}}
</div>


