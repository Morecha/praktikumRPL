<x-app-layout>
	<x-slot name="title">Edit User</x-slot>

	{{-- show alert if there is errors --}}
	<x-alert-error/>

	<x-card>
		<form action="{{route('admin.katbarang.update',$update->id)}}" method="post">
			@csrf

			<div class="row">
				<div class="col-md-6">
					<x-input text="Nama Kategori" name="kategori" type="text" value="{{$update->kategori}}" />
				</div>
			</div>

			<x-button type="primary" text="Submit" for="submit" />

		</form>
	</x-card>
</x-app-layout>
