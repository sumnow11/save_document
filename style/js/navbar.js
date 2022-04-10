
        var menu_btn = document.querySelector("#menu-btn")
        var sidebar = document.querySelector("#sidebar")
        var container = document.querySelector(".my-container")
        menu_btn.addEventListener("click", () => {
            sidebar.classList.toggle("active-nav")
            container.classList.toggle("active-cont")
        })
        function showlogo() {
            var ds = document.getElementById("logo");
            if(ds.style.display == 'none')
                ds.style.display = 'block';
            else if(ds.style.display == 'block')
                ds.style.display = 'none';
        }
  
