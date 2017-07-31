
        ( function( $ ) {
            $( document ).ready( function() {         
                var form = $( "#encodeon-ajax-contact" );
                var wait_message = "Please wait while we validate and send your message..."

                $( function() {
                    $( form ).on( "submit", function( e )
                    {
                        e.preventDefault();

                        $( ".form-response" ).html( wait_message );

                        var formData = $( form ).serialize();

                        $.ajax( {
                            url: "http://localhost:8080/wordpress/plugin-dev-encodeon-contact-form/wp-admin/admin-ajax.php",
                            type: "post",
                            data: formData,
                            success: function ( data, status ) 
                            {
                                if(data) 
                                {
                                    $( ".form-response" ).html( data );
                                    var data_return_status = $( "#data-return-status" ).data( "status" );
                                    if ( data_return_status == true ) 
                                    {
                                        /*
                                         * $( form )[0] converts jquery element back to
                                         * javascript object to use the native reset method
                                         */
                                        $( form )[0].reset();
                                    }
                                }
                            },
                            error: function ( xhr, desc, err ) 
                            {
                                console.log( xhr );
                                console.log( "Details: " + desc + "\nError:" + err );
                            }
                        } ); 
                    });
                });
            });
        }( jQuery ) );

    