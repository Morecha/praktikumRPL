<x-app-layout>
	<x-slot name="title">Pembukuan</x-slot>

	{{-- show alert if there is errors --}}
	<x-alert-error/>

	@if(session()->has('success'))
	<x-alert type="success" message="{{ session()->get('success') }}" />
	@endif
	<x-card>
		<form action="{{route('admin.laporan.store')}}" method="post">
			@csrf
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label for="periode">Periode</label>
                        <select name="bulan" id="periode" class="form-control">
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
					</div>
                </div>
			</div>
            <div class="row">
                <div class="col-md-3">
					<x-input text="Tahun" name="tahun" type="text" />
				</div>
            </div>
			<x-button type="primary" text="Create" for="submit" />
		</form>
	</x-card>
</x-app-layout>
