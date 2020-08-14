;
(function (d, c, $) {
   c("Hello Contact Page Admin Wordpress");
   c(contact_form)

   // usamos la delegacion de eventos para no hacer un foreach
   d.addEventListener("click",e=>{
      if(e.target.matches('.u-delete')){
         e.preventDefault()

         //obtenemos el id del data-contact-id que obtendremos al dar click en la fila que queramos eliminar
         let id = e.target.dataset.contactId
         confirmDelete = confirm(`¿Estas seguro que deseas eliminar el comentario con el ID ${id}`)
         if(confirmDelete){
            $.ajax({
               type:'POST',
               data:{
                  // mandamos el id para capturarlo en php con $_POST['id']
                  'id':id,

                  //y le mandamos el nombre de la funcion que se ejecutara esto es propio de wordpress
                  'action':'mawt_contact_form_delete'
               },
               url: contact_form.ajax_url,

               // cuando se termina la peticion asemos
               success:data=>{
                  let resp = JSON.parse(data)
                  c(resp)
                  if(!data.err){
                     e.target.parentElement.parentElement.remove()
                  }
               }
            })
         }else{
            return false
         }
      }
   })

})(document, console.log, jQuery.noConflict());