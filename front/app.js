import listarProduto from './components/listarProduto.js';
import cadastrarProduto from './components/cadastrarProduto.js';
import atualizarProduto from './components/atualizarProduto.js';
import deletarProduto from './components/deletarProduto.js';

const apiBaseUrl = 'http://localhost:8080';

const app = Vue.createApp({
  template: `
    <div>
      <listar-produto :api-base-url="apiBaseUrl"></listar-produto>
      <cadastrar-produto :api-base-url="apiBaseUrl"></cadastrar-produto>
      <atualizar-produto :api-base-url="apiBaseUrl"></atualizar-produto>
      <deletar-produto :api-base-url="apiBaseUrl"></deletar-produto>
    </div>
  `,
  data() {
    return {
      apiBaseUrl: apiBaseUrl
    };
  }
});

app.component('listar-produto', listarProduto);
app.component('cadastrar-produto', cadastrarProduto);
app.component('atualizar-produto', atualizarProduto);
app.component('deletar-produto', deletarProduto);

app.mount('#app');
