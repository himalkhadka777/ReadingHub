


<div class="latest-products">
      <div class="container">
        <div class="row"> 
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Latest Products</h2>
              <a href="products.html">view all products <i class="fa fa-angle-right"></i></a>
              <form action="{{url('search')}}" method="get" class="form-inline" style="float: right; padding: 10px;"> 
                @csrf  
                <input class="form-control" type="search" name="search" placeholder="search">
                <input type="submit" value="search" class="btn btn-success">
              </form>
            </div>
          </div>
<!-- 
          <div class="col-md-12 text-center">
             <form action="{{url('topthree')}}" method="POST"> 
              <input class="btn" type="submit" value="Top 3 to cart" placeholder="Top 3 to cart" style="margin:20px;background-color:maroon;color:white;"/>
            </form>
          </div> -->
          
          @foreach($data as $product)

          <div class="col-md-4">
            <div class="product-item">
              <a href="#"><img height="250" width="100" src="/productimage/{{$product->image}}" alt=""></a>
              <div class="down-content">
                <a href="#"><h4>{{$product->title}}</h4></a>
                <h6>Price: ${{$product->price}}</h6>
                <p>{{$product->description}}</p> 
             <form action="{{url('addcart',$product->id)}}" method="POST"> 
             @csrf 
             <input type="number" value="1" min="1" class="form-control" style="width: 100px" name="quantity">
             <br>
             <input type="submit" class="btn btn-primary" value="Add Cart">
             </form>   
              </div> 
            </div>
          </div>

          @endforeach
          

        
          @if(method_exists($data,'links'))

          <div class="col-md-12 text-center">
            <div class="d-flex justify-content-center">
                {!! $data->links() !!}
            </div> 
          </div>

          @endif

        </div>
      </div>
    </div>