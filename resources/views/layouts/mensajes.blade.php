@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show alert-important " role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="position: unset; margin-top: unset; color: red;">
        <span aria-hidden="false">&times;</span>
      </button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session('info'))
  @php unset($info); @endphp
  	<div class="alert alert-success alert-dismissible fade show alert-important" role="alert" >
        <strong>{{ session('info') }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="position: absolute; margin-top: unset; color: white;">
        <span aria-hidden="false">&times;</span>
      </button>
    </div>
@endif
@if(isset($info))
  	<div class="card alert alert-info alert-dismissible fade show alert-important" role="alert" >
  		<strong>{{ $info }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="position: absolute; margin-top: unset; color: white; ">
        <span aria-hidden="false">&times;</span>
      </button>
    </div>
@endif
{{-- @if(isset($info))
	<div class="alert alert-danger alert-dismissible fade show " role="alert">
		<strong>		{{ Auth::user()->name }} {{ $info }}		</strong>
	</div>
@endif --}}
