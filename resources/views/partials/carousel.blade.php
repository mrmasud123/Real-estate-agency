<div class="intro intro-carousel">
    <div id="carousel" class="owl-carousel owl-theme">
      @foreach ($propertyData as $property)
      @php
        $firstImage = null;
        if (!empty($property->propertyAssets->images)) {
            $images = explode(',', $property->propertyAssets->images);
            $firstImage = url('uploads/property_images/' . $images[0]);
        }

      @endphp 
      <div class="carousel-item-a intro-item bg-image" style="background-image: url({{  $firstImage }})">
        <div class="overlay overlay-a"></div>
        <div class="intro-content display-table">
          <div class="table-cell">
            <div class="container">
              <div class="row">
                <div class="col-lg-8">
                  <div class="intro-body">
                    @php
                      $propertyAddress=explode(',', $property->asset_location);
                    @endphp
                    <p class="intro-title-top">{{ $propertyAddress[0] }}
                      <br> {{ $propertyAddress[1] }}</p>
                    <h1 class="intro-title mb-4">
                      <span class="color-b">{{ $property->property_category }} </span>
                    <p class="intro-subtitle intro-price">
                      <a href="#"><span class="price-a">{{ $property->sale_type }} | {{ $property->propertyFeature->property_price }} Tk.</span></a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      @endforeach
     
    </div>
</div>