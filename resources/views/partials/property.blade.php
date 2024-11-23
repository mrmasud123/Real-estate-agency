<section class="section-property section-t8">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-wrap d-flex justify-content-between">
            <div class="title-box">
              <h2 class="title-a">Latest Properties</h2>
            </div>
            <div class="title-link">
              <a href="property-grid.html">All Property
                <span class="ion-ios-arrow-forward"></span>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div id="property-carousel" class="owl-carousel owl-theme">
        @foreach ($propertyData as $property)
        @php
        $firstImage = null;
        if (!empty($property->propertyAssets->images)) {
            $images = explode(',', $property->propertyAssets->images);
            $firstImage = url('uploads/property_images/' . $images[0]);
        }

      @endphp 
        <div class="carousel-item-b">
          <div class="card-box-a card-shadow">
            <div class="img-box-a">
              <img src="{{  $firstImage }}" alt="" class="img-a img-fluid">
            </div>
            <div class="card-overlay">
              <div class="card-overlay-a-content">
                <div class="card-header-a">
                  <h2 class="card-title-a">
                    <a href="property-single.html">206 Mount
                      <br /> Olive Road Two</a>
                  </h2>
                </div>
                <div class="card-body-a">
                  <div class="price-box d-flex">
                    <span class="price-a">{{ $property->sale_type }} | {{ $property->propertyFeature->property_price }} Tk.</span>
                  </div>
                  <a href="#" class="link-a">Click here to view
                    <span class="ion-ios-arrow-forward"></span>
                  </a>
                </div>
                <div class="card-footer-a">
                  <ul class="card-info d-flex justify-content-around">
                    <li>
                      <h4 class="card-info-title">Area</h4>
                      <span>
                        {{ $property->propertyFeature->area }} Sq ft.
                      </span>
                    </li>
                    <li>
                      <h4 class="card-info-title">Beds</h4>
                      <span>{{ $property->propertyFeature->bed }}</span>
                    </li>
                    <li>
                      <h4 class="card-info-title">Bath</h4>
                      <span>{{ $property->propertyFeature->bath }}</span>
                    </li>
                    <li>
                      <h4 class="card-info-title">
                        Garage
                      </h4>
                      <span>{{ $property->propertyFeature->garage =='yes' ? "Available": "Not Available" }}</span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>

        @endforeach
      </div>
    </div>
  </section>