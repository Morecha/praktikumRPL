<x-app-layout>
	<x-slot name="title">Pembukuan</x-slot>

	@if(session()->has('success'))
	<x-alert type="success" message="{{ session()->get('success') }}" />
	@endif
	<x-card>
		<x-slot name="title">All Laporan</x-slot>
		<x-slot name="option">
			<a href="{{ route('admin.laporan.create') }}" class="btn btn-success">
				<i class="fas fa-plus"></i>
			</a>
		</x-slot>
        <table class="table table-bordered">
			<thead>
				<th style="width:3%">No</th>
				<th style="width:50%; text-align:center;">Periode</th>
                <th style="text-align:center;">tahun</th>
                <th style="text-align:center;">show</th>
                <th style="text-align:center;">Delete</th>
			</thead>
            @php
                $i = 1;
            @endphp
            @foreach ($laporan as $laporan)
			<tbody>
                <td>{{$i++}}</td>
                <td style="text-align:center;">{{$laporan->bulan}}</td>
                <td style="text-align:center;">{{$laporan->tahun}}</td>
                <td style="text-align:center;">
                    <a href="{{route('admin.laporan.tampilan',$laporan->id)}}" class="btn btn-primary mr-1" target="_blank"><i class="fas fa-eye"></i></a>
                </td>
                <td style="text-align:center;">
                    <form action="{{ route('admin.laporan.delete',$laporan->id) }}" method="post" style="display: inline-block;">
                        @csrf
                        <button type="button" class="btn btn-danger delete"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tbody>
            @endforeach
		</table>
	</x-card>

    <x-slot name="script">
		<script>
			$('.delete').click(function(e){
				e.preventDefault()
				const ok = confirm('Ingin menghapus Pembukuan?')
				if(ok) {
					$(this).parent().submit()
				}
			})
		</script>
	</x-slot>

</x-app-layout>
