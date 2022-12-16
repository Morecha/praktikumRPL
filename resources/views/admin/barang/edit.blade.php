<x-app-layout>
	<x-slot name="title">Edit User</x-slot>

	{{-- show alert if there is errors --}}
	<x-alert-error/>

	<x-card>
		<form action="{{ route('admin.barang.update',$barang->id) }}" method="post">
			@csrf

			<div class="row">
				<div class="col-md-6">
					<x-input text="Nama Barang" name="nama" type="text" value="{{$barang->nama}}" />
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select name="id_kategori" id="kategori" class="form-control">
                            <option selected value="{{$kategori->id}}"> {{$kategori->kategori}} </option>
                            @foreach ($allkategori as $allkategori)
                                <option value="{{$allkategori->id}}">{{$allkategori->kategori}}</option>
                            @endforeach
                        </select>
                    </div>
				</div>
            </div>

			<x-button type="primary" text="Submit" for="submit" />

		</form>
	</x-card>
</x-app-layout>
