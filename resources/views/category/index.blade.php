@extends('layouts.app')

@section('content')

<div class="contener">
    <div class="row">
        <div class="col-md-6 offset-md-3">

        <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">@lang('Nom de la catégorie')</th>
                    <th scope="col">@lang('Opérations')</th>
                    
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)

                    <tr>
                        <td>{{$category->name}}</td>
                        <td>
                            <a type="button" href="{{route('category.destroy', $category->id)}}" class="btn btn-danger btn-sm pull-right" data-toggle="tooltip" title="@lang('Supprimer la catégorie') {{ $category->name }}">
                                <i class="fas fa-trash fa-lg"></i>
                            </a>
                            <a type="button" href="{{ route('category.edit', $category->id) }}" class="btn btn-info btn-sm pull-right mr-2" data-toggle="tooltip" title="@lang('Modifier la catégorie') {{ $category->name }}">
                                <i class="fas fa-edit fa-lg"></i>
                            </a>
                        </td>

                    </tr>
                @endforeach
               
                </tbody>
        </table>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js">

</script>
<script>
        $(function() {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            })
            $('[data-toggle="tooltip"]').tooltip()
            $('a.btn-danger').click(function(e) {
                let that = $(this)
                e.preventDefault()
                const swalWithBootstrapButtons = swal.mixin({
  confirmButtonClass: 'btn btn-success',
  cancelButtonClass: 'btn btn-danger',
  buttonsStyling: false,
})

        swalWithBootstrapButtons({
            title: '@lang('Vraiment supprimer cette catégorie ?')',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: '@lang('Oui')',
            cancelButtonText: '@lang('Non')',
            
        }).then((result) => {
            if (result.value) {
                $('[data-toggle="tooltip"]').tooltip('hide')
                    $.ajax({                        
                        url: that.attr('href'),
                        type: 'DELETE'
                    })
                    .done(function () {
                            that.parents('tr').remove()
                    })

                swalWithBootstrapButtons(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
                
                
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
                )
            }
        })
            })
        })
    </script>
@endsection