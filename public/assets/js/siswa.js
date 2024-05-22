$('#editSiswa').on('show.bs.modal', function (e) {
    // get information to update quickly to modal 
   var opener=e.relatedTarget;//this holds the element who called the modal
   //get details from attributes
   var name=$(opener).attr('data-name');
   var category=$(opener).attr('data-category');
   var nilai = $(opener).attr('data-nilai');

  
   //set it in form
   $('#editSiswa').find('[name="category"]').val(category);
   $('#editSiswa').find('[name="name"]').val(name);
   $('#editSiswa').find('[name="nilai"]').val(nilai); // set id to hidden field whose name="id"
  
   });