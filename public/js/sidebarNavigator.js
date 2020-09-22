window.addEventListener('DOMContentLoaded', (event) => {

        const openBtn = document.getElementById('sidebar-collapse');
        const closeBtn = document.getElementById('close-button');
        const sidebar = document.getElementById('sidebar');
        const pageContentText = document.getElementById('page-content-text');
        const pageContent = document.getElementById('page-content');

        openBtn.addEventListener('click', ()=>{
            sidebar.style.display = "flex";
            sidebar.style.flex = 10;
            pageContentText.style.display = "none";
            pageContent.style.opacity = "10%";
        });

        closeBtn.addEventListener('click', ()=>{
            sidebar.style.display = "none";
            pageContentText.style.display = "block";
            pageContent.style.opacity = "100%";
        });
        
  });
