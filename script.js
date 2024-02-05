
document.addEventListener("DOMContentLoaded", function() {
  // حدد عناصر قائمة التنقل
  var navLinks = document.querySelectorAll("nav a");

  // حدد أقسام الصفحة
  var sections = document.querySelectorAll("section");

  // أضف مستمع حدث التمرير إلى نافذة المتصفح
  window.addEventListener("scroll", function() {
    // احصل على موضع التمرير الحالي
    var scrollTop = window.pageYOffset;

    // حدد القسم النشط بناءً على موضع التمرير
    var activeSection = null;
    sections.forEach(function(section) {
      if (scrollTop >= section.offsetTop - 100) {
        activeSection = section;
      }
    });

    // أضف وإزالة فئة "section-active" من أقسام الصفحة
    sections.forEach(function(section) {
      section.classList.remove("section-active");
    });
    if (activeSection) {
      activeSection.classList.add("section-active");
    }

    // أضف وإزالة فئة "active" من عناصر قائمة التنقل
    navLinks.forEach(function(link) {
      link.classList.remove("active");
    });
    var activeLink = document.querySelector("nav a[href='#" + activeSection.id + "']");
    if (activeLink) {
      activeLink.classList.add("active");
    }
  });
});

// وظيف تغيير لون الخلفية باستمرار
setInterval(function() {
  var colors = ["#000", "#111", "#222", "#333", "#444", "#555", "#666", "#777", "#888", "#999"];
  var randomColor = colors[Math.floor(Math.random() * colors.length)];
  document.body.style.backgroundColor = randomColor;
}, 1000);