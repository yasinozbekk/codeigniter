	productDetail();
	deleteProduct();


	function productDetail() {
		$( ".productDetail" ).click(function() {
			$(".subdataPrint").remove();			
		  	var id = $(this).attr("data-id");
		  	var url = $(this).attr("data-url");
		  	var dataControl = true;
	  		$.ajax({
				url: url,
				type: "POST",
	 			dataType: 'json',
				success:function(data) {
					if(data.length>0){
						data.forEach(function(data,index){
							if(data.materials_name){
								$(".dataPrint_"+id).append("<ul><li>"+data.materials_name+"</li></ul>")
							}
							if(data.products_name){
								$(".dataPrint_"+id).append('<ul><li class="subdataPrint subdataPrint_'+data.products_id+'">'+data.products_name+''+
									'<i class="bx bx-plus-circle font-18 text-primary subProductDetail" data-id="'+data.products_id+'" data-url="/deneme/'+data.products_id+'"></i>'+

									'<i class="bx bx-trash font-18 text-danger deleteProduct"></i>'+
								'</li></ul>')
							}
						})
						subProductDetail();
					}else{
						dataControl = false;
					}
				},
				async: false
			});
			if(dataControl == false){
				$(this).remove();
			}

		});
	}


	function subProductDetail() {
		$( ".subProductDetail" ).click(function() {
		  	var id = $(this).attr("data-id");
		  	var url = $(this).attr("data-url");
		  	var dataControl = true;
		  	url = window.location.href + url;
	  		$.ajax({
				url: url,
				type: "POST",
	 			dataType: 'json',
				success:function(data) {
					if(data.length>0){
						data.forEach(function(data,index){
							if(data.materials_name){
								$(".subdataPrint_"+id).append("<ul><li>"+data.materials_name+"</li></ul>")
							}
							if(data.products_name){
								$(".subdataPrint_"+id).append('<ul><li>'+data.products_name+''+
								'</li></ul>')
							}
						})
					}else{
						dataControl = false;
					}
					
				},
				async: false
			});
			if(dataControl == false){
				$(this).remove();
			}

		});
	}


	function deleteProduct() {
		$( ".deleteProduct" ).click(function() {
		  	var id = $(this).attr("data-id");
		  	var url = $(this).attr("data-url");
			Swal.fire({
				title: 'Ürünü silmek istediğinizden emin misiniz?',
				// showDenyButton: true,
				showCancelButton: true,
				cancelButtonText: "İptal",
				confirmButtonText: 'Evet, Sil',
				// denyButtonText: `Don't save`,
			}).then((result) => {
			/* Read more about isConfirmed, isDenied below */
			if (result.isConfirmed) {
				$(location).attr('href', url);

				// Swal.fire('Saved!', '', 'success')
			} else if (result.isDenied) {
				Swal.fire('Changes are not saved', '', 'info')
			}
			})
		});
	}