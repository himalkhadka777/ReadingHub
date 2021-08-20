<!DOCTYPE html>
<html lang="en">
  <head>

    @include('admin.css')
    
  </head>
  <body>
 
     @include('admin.sidebar')
      <!-- partial -->
     @include('admin.navbar')                                                                                                             
        <!-- partial --> 
      
      <div style="padding-bottom:30px;" class="container-fluid page-body-wrapper">

      <div class="container" align="center">

      @if(session()->has('message'))

      <div class="alert alert-success"> 

      <button type="button" class="close" data-dismiss="alert">x</button>

      {{session()->get('message')}}

      </div> 

      @endif
 

      	<table>
      		<tr align="center" style="background-color: maroon"> 
      			
      			<td style="padding: 20px"><b>Title</b></td>
      			<td style="padding: 20px"><b>Description</b></td>
      			<td style="padding: 20px"><b>Quantity</b></td>
      			<td style="padding: 20px"><b>Price</b></td>
      			<td style="padding: 20px"><b>Image</b></td>
      			<td style="padding: 20px"><b>Update</b></td>
      			<td style="padding: 20px"><b>Delete</b></td>
 
      		</tr> 

      		@foreach($data as $product)

      		<tr align="center" style="background-color: black;">
      			
      			<td>{{$product->title}}</td>
      			<td>{{$product->description}}</td>
      			<td>{{$product->quantity}}</td>
      			<td>{{$product->price}}</td>
      			<td>
      				<img src="/productimage/{{$product->image}}" height="200" width="200">
      			</td> 
  			

  				<td>
  					<a class="btn btn-primary" href="{{url('updateview',$product->id)}}">Update</a>
  				</td> 

  				<td>
  					<a class="btn btn-danger" href="{{url('deleteproduct',$product->id)}}">Delete</a>
  				</td>

      		</tr>

      		@endforeach
      	</table>

      </div>
  	  </div>
          <!-- partial -->
     @include('admin.script') 
  </body> 
</html> 