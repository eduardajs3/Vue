export default {
  props: ['apiBaseUrl'], 
  data() {
    return {
      produto: {
        nome: '',
        descricao: '',
        preco: '',
        estoque: '',
        userInsert: '' 
      },
      erros: [] 
    };
  },
  methods: {
    validarProduto() {
      this.erros = []; 
      if (!this.produto.nome) {
        this.erros.push("O nome deve ser preenchido.");
      } else if (this.produto.nome.length <= 3) {
        this.erros.push("O nome deve ter mais de 3 caracteres.");
      }

      if (!this.produto.descricao) {
        this.erros.push("A descrição deve ser preenchida.");
      }

      if (!this.produto.preco && this.produto.preco !== 0) {
        this.erros.push("O preço deve ser preenchido.");
      } else if (this.produto.preco <= 0) {
        this.erros.push("O preço deve ser maior que 0.");
      }

      if (!this.produto.estoque && this.produto.estoque !== 0) { 
        this.erros.push("O estoque deve ser preenchido.");
      } else if (this.produto.estoque < 0) {
        this.erros.push("O estoque deve ser maior ou igual a 0.");
      }

      if (!this.produto.userInsert) {
        this.erros.push("O campo de usuário que insere o produto deve ser preenchido.");
      }
      
      return this.erros.length === 0; 
    },
    cadastrarProduto() {
      if (this.validarProduto()) { 
        fetch(`${this.apiBaseUrl}/produtos`, { 
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(this.produto) 
        })
        .then(response => response.json())
        .then(data => {
          alert('Produto cadastrado com sucesso!');
          this.produto = { nome: '', descricao: '', preco: '', estoque: '', userInsert: '' }; // Limpa os campos
        })
        .catch(error => console.error('Erro ao cadastrar:', error));
      } else {
        alert(this.erros.join("\n"));
      }
    }
  },
  template: `
    <div>
      <h2>Cadastrar Produto</h2>
      <input v-model="produto.nome" placeholder="Nome do produto">
      <input v-model="produto.descricao" placeholder="Descrição do produto">
      <input v-model="produto.preco" type="number" placeholder="Preço do produto">
      <input v-model="produto.estoque" type="number" placeholder="Estoque do produto">
      <input v-model="produto.userInsert" placeholder="Usuário que está inserindo o produto">
      <div class="botoes-container">
      <button @click="cadastrarProduto">Cadastrar</button>
      </div>
    </div>
    `
};
