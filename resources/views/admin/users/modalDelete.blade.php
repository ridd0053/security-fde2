<div id="DeleteModal" class="modal fade text-danger" role="dialog">
   <div class="modal-dialog ">
     <!-- Modal content-->
     <form action="" id="deleteForm" method="post">
         <div class="modal-content">
             <div class="modal-header bg-danger">
                 <button type="button" class="close" data-dismiss="modal"></button>
                 <h4 class="modal-title justify-content-start text-light">Confirmatie voor verwijderen.</h4>
             </div>
             <div class="modal-body">
                 @csrf
                 @method('DELETE')
                 
                 <p >Weet je zeker dat  je wilt verwijderen?</p>
             </div>
             <div class="modal-footer  justify-content-start">
                 
                     <button type="button" class="btn btn-success" data-dismiss="modal">Nee liever niet</button>
                     <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Ja, verwijder definitief</button>
                 
             </div>
         </div>
     </form>
   </div>
  </div>

   
    
    
