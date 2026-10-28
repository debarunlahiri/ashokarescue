document.addEventListener("DOMContentLoaded", function () {
    window.addEventListener('scroll', function () {
      if (window.scrollY > 150) {
        document.getElementById('header').classList.add('fixed-top');
        // add padding top to show content behind navbar
        navbar_height = document.querySelector('.navbar').offsetHeight;
        document.body.style.paddingTop = navbar_height + 'px';
      } else {
        document.getElementById('header').classList.remove('fixed-top');
        // remove padding top from body
        document.body.style.paddingTop = '0';
      }
    });
  }); 
  
  var scrollToTopBtn = document.querySelector(".scroll-top");
  var rootElement = document.documentElement;
  
  function handleScroll() {
    // Do something on scroll
    var scrollTotal = rootElement.scrollHeight - rootElement.clientHeight;
    if (rootElement.scrollTop / scrollTotal > 0.03) {
      // Show button
      scrollToTopBtn.classList.add("scrolltopactive");
    } else {
      // Hide button
      scrollToTopBtn.classList.remove("scrolltopactive");
    }
  }
  
  function scrollToTop() {
    // Scroll to top logic
    rootElement.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  }
  scrollToTopBtn.addEventListener("click", scrollToTop);
  document.addEventListener("scroll", handleScroll);