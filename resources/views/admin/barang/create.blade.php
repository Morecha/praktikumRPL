<x-app-layout>
	<x-slot name="title">New User</x-slot>

	{{-- show alert if there is errors --}}
	<x-alert-error/>

	@if(session()->has('success'))
	<x-alert type="success" message="{{ session()->get('success') }}" />
	@endif
	<x-card>
		<form action="{{route('admin.barang.store')}}" method="post">
			@csrf

			<div class="row">
				<div class="col-md-6">
					<x-input text="Barang" name="nama" type="text" />
				</div>
            </div>
            <div class="row">
				<div class="col-md-6">
					<div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select name="id_kategori" id="kategori" class="form-control">
                            <option> -- Pilih Kategori -- </option>
                            @foreach ($kategori as $kategori)
                                <option value="{{$kategori->id}}">{{$kategori->kategori}}</option>
                            @endforeach
                        </select>
                    </div>
				</div>
            </div>

			<x-button type="primary" text="Submit" for="submit" />

		</form>
	</x-card>
</x-app-layout>
