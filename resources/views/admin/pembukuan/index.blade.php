<x-app-layout>
	<x-slot name="title">Pembukuan</x-slot>

	@if(session()->has('success'))
	<x-alert type="success" message="{{ session()->get('success') }}" />
	@endif
	<x-card>
		<x-slot name="title">All Pembukuan</x-slot>
		<x-slot name="option">
			<a href="{{ route('admin.pembukuan.create') }}" class="btn btn-success">
				<i class="fas fa-plus"></i>
			</a>
		</x-slot>
        <table class="table table-bordered">
			<thead>
				<th style="width:3%">No</th>
				<th style="width:40%; text-align:center;">Barang</th>
                <th style="text-align:center;">kategori</th>
                <th style="text-align:center;">Tanggal</th>
                <th style="text-align:center;">Status</th>
                <th style="text-align:center;">Jumlah</th>
                <th style="width:15%; text-align:center;">Opsi</th>
			</thead>
            @php
                $i = 1;
            @endphp
            @foreach ($barang as $barang)
			<tbody>
                <td>{{$i++}}</td>
                <td style="text-align:center;">{{$barang->nama}}</td>
                <td style="text-align:center;">{{$barang->kategori}}</td>
                <td style="text-align:center;">{{$barang->updated_at}}</td>
                <td style="text-align:center;">{{$barang->status}}</td>
                <td style="text-align:center;">{{$barang->jumlah}}</td>
                <td style="text-align:center;">
                    <a href="{{ route('admin.pembukuan.edit',$barang->id) }}" class="btn btn-primary mr-1"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.pembukuan.delete',$barang->id) }}" method="post" style="display: inline-block;">
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
