@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-container py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><a href="#">Success Stories</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- Success stories HTML -->
<div class="container">
    <div class="content-box">
      <div class="success-stories">
        <h1>Success Stories</h1>
        <div class="title-section">
          <h4>BUYERS on EBB</h4>
        </div>
        <p>We measure our success by our clients’ satisfaction and the number of businesses we have helped transition from one owner to another over the years. Read what <a href="#" class="sellorgive">business sellers</a> are saying about EBB.</p>
        <div class="row">
          <div class="col-md-6">
            <div class="testimonial-card">
              <div class="quote-icon-wrapper">
                <div class="quote-icon">❝</div>
              </div>
              <blockquote>
                Executive Business Brokers are the most competent and pleasant brokers I have ever had the pleasure of working with. I was surprised by their prompt response and depth of information they provided to me on the businesses they represent. I couldn't have asked for a more honest and knowledgeable firm to help me through the process. At the closing I knew the agreement we reached was fair, and after a few months of running the business I still feel great about the deal.
              </blockquote>
              <footer>Roman Tsitselyuk, Wine Cellars</footer>
            </div>
          </div>
          <div class="col-md-6">
            <div class="testimonial-card">
              <div class="quote-icon-wrapper">
                <div class="quote-icon">❝</div>
              </div>
              <blockquote>
                I had been looking for a business to purchase for some time. Executive Business Brokers helped me quickly identify the businesses that met my requirements and found me a business opportunity. Throughout negotiations and the due diligence process, they were very professional. Information was supplied to me in a timely manner and they helped me make good decisions. They were diligent in ensuring that the transaction did, in fact, come to a satisfactory conclusion.
              </blockquote>
              <footer>Harvey Schweiger, Kareena Laundromat</footer>
            </div>
          </div>
          <div class="col-md-6">
            <div class="testimonial-card">
              <div class="quote-icon-wrapper">
                <div class="quote-icon">❝</div>
              </div>
              <blockquote>
                After many frustrating months searching for a restaurant, I received a call from Larry Bodner. Having worked with Executive Business Brokers before I always find them to be very knowledgeable and extremely professional. Larry indicated he had the perfect opportunity for me and that he will pick me up in 15 minutes to see the restaurant. The rest is, as they say, history. The restaurant has become tremendously successful!
              </blockquote>
              <footer>Dominic Coscia, IL Michelangelo</footer>
            </div>
          </div>
          <div class="col-md-6">
            <div class="testimonial-card">
              <div class="quote-icon-wrapper">
                <div class="quote-icon">❝</div>
              </div>
              <blockquote>
                Executive Business Brokers guided us through difficult negotiations to acquire a well-respected business. They were able to work through a complicated deal structure involving attorneys, accountants and a landlord. Because of their involvement, the transaction went very well and we are pleased that we have been able to retain most of the customer base.
              </blockquote>
              <footer>Lee Container, Melvin Fine</footer>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<style>
      .breadcrumb-container {
        background-color: #F8F8F8;
    }

    .breadcrumb-item a {
        text-decoration: none;
        color: #333333;
    }

    .breadcrumb-item.active {
        color: #333333;
    }
  .success-stories {
      text-align: center;
      padding: 0px 20px 50px 20px;
    }
    .success-stories h1 {
      font-size: 25px;
      font-weight: bold;
      color: #000;
      position: relative;
      display: inline-block;
    }
    .success-stories h1::after {
    content: "";
    display: block;
    width: 980px;
    height: 1px;
    background-color: #B3B3B3;
    margin: 25px auto 20px;
}
    .success-stories p {
      font-size: 16px;
      color: #555;
      margin-bottom: 40px;
    }
    .testimonial-card {
      background-color: #fff;
      height: 260px;
      margin-top: 50px;
      border-radius: 10px;
      padding: 25px;
      margin-bottom: 20px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
      position: relative;
    }
    .testimonial-card .quote-icon-wrapper {
      position: absolute;
      top: -20px;
      left: 20px;
      width: 50px;
      height: 50px;
      background-color: #F8F8F8;
      border-radius: 50%;
      border: 1px solid #D9D9D9;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .testimonial-card .quote-icon {
      font-size: 45px;
      margin-top: 18px;
      color: #806132;
    }
    .testimonial-card blockquote {
    font-size: 14px;
    color: #666;
    /* margin-left: 30px; */
    text-align: left;
    margin-top: 20px;
}
.testimonial-card footer {
    margin-top: 15px;
    font-size: 18px;
    font-weight: bold;
    color: #A67C52;
    text-align: left;
}
    .content-box {
      background-color: #FFFFFF;
      padding: 30px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .title-section h4 {
    color: #806132;
    font-weight: 900;
}
</style>
@endsection