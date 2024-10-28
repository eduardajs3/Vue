export default {
  props: ['apiBaseUrl'], 
  data() {
    return {
      produtos: []
    };
  },
  created() {
    this.fetchProdutos();
  },
  methods: {
    fetchProdutos() {
      fetch(`${this.apiBaseUrl}/produtos`) 
        .then(response => response.json())
        .then(data => {
          this.produtos = data;
        })
        .catch(error => console.error('Error:', error));
    }
  },
  template: `
    <div>
      <h2>Lista de Produtos</h2>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Estoque</th>
            <th>User Insert</th> <!-- Adicionado a coluna userInsert -->
          </tr>
        </thead>
        <tbody>
          <tr v-for="produto in produtos" :key="produto.produto_id">
            <td>{{ produto.produto_id }}</td>
            <td>{{ produto.nome }}</td>
            <td>{{ produto.descricao }}</td>
            <td>{{ produto.preco }}</td>
            <td>{{ produto.estoque }}</td>
            <td>{{ produto.userInsert }}</td> <!-- Mostra o campo userInsert -->
          </tr>
        </tbody>
      </table>
    </div>
  `
};
