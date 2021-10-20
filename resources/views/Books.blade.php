@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddBookModal">
                Add New Book
              </button><br><br>
            <div class="card">
                <div class="card-header">{{ __('Books') }} <a style="float: right" href="{{ url('/home') }}">Members</a></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif




<div class="container">
    <div class="row">
        <table class="table" id="booksDataTable">
            <thead>
                <tr>

                    <th scope="col">id</th>
                    <th scope="col">name</th>


                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="booksDataTableBody">


            </tbody>
        </table>
    </div>
</div>




<div class="modal fade" id="AddBookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Books Add</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <label>Name</label>
                        <input id="name" class="form-control" type="text">
                    </div>

                </div>

            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="bookConfirmBtn" type="button" class="btn btn-primary">Add Book</button>
        </div>
      </div>
    </div>
  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="DeleteBookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center p-3">
                <h5 class="mt-4">Do you want to Delete ??</h5>
                <span class="d-none" id="DeleteID"></span>
                <span class="d-none" id="imageURL"></span>
                <span class="d-none" id="image2URL"></span>
                <span class="d-none" id="image3URL"></span>
                <span class="d-none" id="image4URL"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">No</button>
                <button  id="DeleteBookConfirm" type="button" class="btn btn-danger">Yes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="EditBookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Book Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <span class="d-none" id="BookID"></span>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <label>Name</label>
                        <input id="e_name" class="form-control" type="text">
                    </div>

                </div>

            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="e_confirm_book" type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
DataList()

function DataList() {
    let URL = "/getBookData";
    axios.get(URL).then(function(response) {
        if (response.status == 200) {
            console.log(response.data)

            $('#booksDataTableBody').empty();
            $.each(response.data, function(i, item) {
                let tableRow = "<tr>" +
                    "<td>" + item['id'] + "</td>" +
                    "<td>" + item['b_name'] + "</td>" +


                    "<td>" +
                    "<div class='dropdown'>" +
                    "<button class='btn btn-sm btn-dark  dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Dropdown button</button>" +
                    "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>" +
                        "<a class='dropdown-item editBook' data-id="+item['id']+" href='#'>Edit Member</a>"+
                    "<a class='dropdown-item deleteItem' data-id=" + item['id'] +
                    " href='#'>Delete</a>" +
                    "</div>" +
                    "</div>" +
                    "</td>" +
                    "</tr>";
                $('#booksDataTableBody').append(tableRow);
            });

            $('.deleteItem').on('click', function() {
                let id = $(this).data('id');
                $('#DeleteID').html(id);
                $('#DeleteBookModal').modal('show');
            })

            $('.editBook').on('click',function () {
                let idEdit=$(this).data('id');
                $('#BookID').html(idEdit);
                GetBookNameEditData(idEdit);
                $('#EditBookModal').modal('show');
            })




        } else {
            console.log("no")
        }

    }).catch(function(error) {
        console.log(error)
    });


}
// end getdata book function



$('#bookConfirmBtn').on('click',function(){
    let name= $('#name').val();


    let UploadFormData=new FormData();
        UploadFormData.append('name',name);

        let URL="/bookAdd";
        let AxiosHeaderConfig = {
            headers: { 'Content-Type': 'multipart/form-data' },

        };

        axios.post(URL,UploadFormData,AxiosHeaderConfig).then(function(response){
            if(response.status==200){

            $('#name').val("");

            $('#AddBookModal').modal('hide');
            DataList();

            }  else{
                 $('#AddBookModal').modal('hide');
            }
        }).catch((erroe)=>{

        })


})

// end add member function

$('#DeleteBookConfirm').click(function(event) {
    let id = $('#DeleteID').html();
    console.log('khaise')

    BookDelete(id);
});
function BookDelete(deleteID) {



let URL = "/bookDelete";
let AxiosConfig = {
    headers: {
        'Content-Type': 'application/json'
    }
};

axios.post(URL, {id: deleteID}, AxiosConfig).then(function(response) {



    if (response.data === 1) {

        $('#DeleteBookModal').modal('hide');

        DataList();
    } else {
        $('#DeleteBookModal').modal('hide');

    }

}).catch(function(error) {

    $('#DeleteBookModal').modal('hide');

});
}

function GetBookNameEditData(idDetails){

let URL="/GetBookDetails";
let AxiosConfig = { headers: { 'Content-Type': 'application/json' } };
axios.post(URL,{id:idDetails},AxiosConfig).then(function (response) {

    if (response.status===200) {
        $('#EditMemberModal').modal('show');
        let EditData=response.data;

        $('#e_name').val(EditData[0]['b_name']);

    }
    else {
        $('#EditBookModal').modal('hide');

    }

}).catch(function (error) {
    $('#EditBookModal').modal('hide');

});
}


$('#e_confirm_book').on('click',function (){
            let BookID= $('#BookID').html();
            let e_name= $('#e_name').val();
            console.log(BookID)





                let UploadFormData=new FormData();
                UploadFormData.append('id',BookID);
                UploadFormData.append('e_name',e_name);

                let URL="/BookDetailUpdate";
                let AxiosHeaderConfig = {
                    headers: { 'Content-Type': 'multipart/form-data' }

                    }

                axios.post(URL,UploadFormData,AxiosHeaderConfig).then(function (response){



                    if(response.status==200){

                        $('#EditBookModal').modal('hide');
                        DataList();

                    }
                    else{
                        $('#EditBookModal').modal('hide');

                    }

                }).catch(function (error){

                });

        })
</script>
@endsection
