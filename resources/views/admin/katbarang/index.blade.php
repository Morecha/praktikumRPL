<x-app-layout>
	<x-slot name="title">Kategori Barang</x-slot>

	@if(session()->has('success'))
	<x-alert type="success" message="{{ session()->get('success') }}" />
	@endif
	<x-card>
		<x-slot name="title">All Kategori Barang</x-slot>
		<x-slot name="option">
			<a href="{{ route('admin.katbarang.create') }}" class="btn btn-success">
				<i class="fas fa-plus"></i>
			</a>
		</x-slot>
        <table class="table table-bordered">
			<thead>
				<th style="width:3%">No</th>
				<th style="width:80%; text-align:center;">Kategori Barang</th>
                <th style="text-align:center;">Option</th>
			</thead>
            @php
                $i = 1;
            @endphp
            @foreach ($data as $data)
			<tbody>
                <td>{{$i++}}</td>
                <td style="text-align:center;">{{$data->kategori}}</td>
                <td style="text-align:center;">
                    <a href="{{ route('admin.katbarang.edit',$data->id) }}" class="btn btn-primary mr-1"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.katbarang.delete',$data->id) }}" method="post" style="display: inline-block;">
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
				const ok = confirm('Ingin menghapus Kategori?')
				if(ok) {
					$(this).parent().submit()
				}
			})
		</script>
	</x-slot>

</x-app-layout>
