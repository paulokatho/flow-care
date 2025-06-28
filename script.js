document.addEventListener('DOMContentLoaded', () => {
    const tabLinks = document.querySelectorAll('.tab-link');
    const tabContents = document.querySelectorAll('.tab-content');
  // Botão para recolher/expandir a sidebar
const toggleBtn = document.getElementById('toggle-btn');
const sidebar = document.getElementById('sidebar');

toggleBtn.addEventListener('click', () => {
  sidebar.classList.toggle('collapsed');
});

    tabLinks.forEach(link => {
      link.addEventListener('click', (e) => {
        // Remover a classe "active" de todas as abas e links
        tabLinks.forEach(link => link.classList.remove('active'));
        tabContents.forEach(content => content.classList.remove('active'));
  
        // Adicionar a classe "active" à aba clicada e seu conteúdo correspondente
        e.target.classList.add('active');
        const activeTab = document.querySelector(e.target.getAttribute('href'));
        activeTab.classList.add('active');
      });
    });
  });
 
  
  