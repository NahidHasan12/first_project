


  <!-- Modal -->
<div class="modal fade" id="curdModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTitle"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="card-body">
                <form class="storeData" id="dataForm" action="" method="POST" enctype="multipart/form-data">
                 @csrf
                 <input type="text" name="editId">
                 <div class="row">
                     <div class="col-6">
                         <div class="mb-3">
                             <label for="name" class="form-label">Full Name</label>
                             <input type="text" id="name" class="form-control" name="name">
                         </div>
                         <div class="mb-3">
                             <label for="roll" class="form-label">Roll Number</label>
                             <input type="number" id="roll" class="form-control" name="roll">
                         </div>
                         <div class="mb-3">
                             <label for="reg" class="form-label">Registration Number</label>
                             <input type="number" id="reg" class="form-control" name="reg">
                         </div>
                         <div class="mb-3" id="department">

                         </div>
                     </div>
                     <div class="col-6">
                         <div class="mb-3">
                             <label for="number" class="form-label">Contact Number</label>
                             <input type="number" id="number" class="form-control" name="number">
                         </div>
                         <div class="mb-3">
                             <label for="mail" class="form-label">Mail Address</label>
                             <input type="mail" id="mail" class="form-control" name="mail">
                         </div>
                         <div class="mb-3">
                             <label for="img" class="form-label">Upload Image</label>
                             <input type="file" id="img" class="form-control" name="img">
                             <div class="img"></div>
                         </div>
                         <div class="text-end">
                            <button type="reset" class="btn btn-sm btn-danger">Reset</button>
                             <button type="submit" class="btn btn-sm btn-primary" id="submitBtn"></button>
                         </div>
                     </div>
                 </div>
                </form>
             </div>
        </div>

      </div>
    </div>
</div>
