export default {
  props: ['apiBaseUrl'],
  data() {
    return {
      produto_id: ''
    };
  },
  methods: {
    deletarProduto() {
     
      if (!this.produto_id) {
        alert('Por favor, insira o ID do produto.');
        return;
      }
      
      
      fetch(`${this.apiBaseUrl}/produtos/${this.produto_id}`, { 
        method: 'DELETE'
      })
        .then(response => response.json())
        .then(data => {
          alert('Produto deletado com sucesso!');
          this.produto_id = ''; 
        })
        .catch(error => console.error('Erro ao deletar:', error));
    }
  },
  template: `
    <div>
      <h2>Deletar Produto</h2>
      <input v-model="produto_id" placeholder="ID do produto">
      <div class="botoes-container">
        <button @click="deletarProduto">Deletar</button>
      </div>
    </div>
  `
};
