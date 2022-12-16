<x-app-layout>
	<x-slot name="title">Edit Pembukuan</x-slot>

	{{-- show alert if there is errors --}}
	<x-alert-error/>

	@if(session()->has('success'))
	<x-alert type="success" message="{{ session()->get('success') }}" />
	@endif
	<x-card>
		<form action="{{route('admin.pembukuan.update',$selected->id)}}" method="post">
			@csrf

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="barang">Barang</label>
                        <select name="id_barang" id="barang" class="form-control">
                            <option value="{{$selected->id_barang}}">{{$nama_barang_selected->nama}}</option>
                            @foreach ($barang as $barang)
                                <option value="{{$barang->id}}">{{$barang->nama}}</option>
                            @endforeach
                        </select>
					</div>
                </div>
			</div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            @if ($selected->status == 'masuk')
                                <option value="masuk" selected>masuk</option>
                                <option value="keluar">keluar</option>
                            @elseif ($selected->status == 'keluar')
                                <option value="keluar" selected>keluar</option>
                                <option value="masuk">masuk</option>
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
					<x-input text="Jumlah" name="jumlah" type="text" value="{{$selected->jumlah}}"/>
				</div>
            </div>
			<x-button type="primary" text="Submit" for="submit" />
		</form>
	</x-card>
</x-app-layout>
