@if (isset($produto->id))
    <form action="{{ route('produto.update', $produto->id) }}" method="post">
        @method('PUT')
@else
    <form action="{{ route('produto.store') }}" method="post">
@endif
        @csrf
        <select name="fornecedor_id" class="borda-preta">
            <option>-- Selecione um Fornecedor --</option>
            @foreach ($fornecedores as $fornecedor)
                <option value="{{ $fornecedor->id }}"  {{ ($produto->fornecedor_id ?? old('fornecedor_id')) == $fornecedor->id ? 'selected' : '' }}>{{ $fornecedor->nome }}</option>
            @endforeach
        </select>
        {{ $errors->has('fornecedor_id') ? $errors->first('fornecedor_id') : '' }}

        <input type="text" name="nome" value="{{ $produto->nome ?? old('nome') }}" placeholder="Nome" class="borda-preta">
        {{ $errors->has('nome') ? $errors->first('nome') : '' }}

        <input type="text" name="descricao" value="{{ $produto->descricao ?? old('descricao') }}" placeholder="Descrição" class="borda-preta">
        {{ $errors->has('descricao') ? $errors->first('descricao') : '' }}

        <input type="text" name="peso" value="{{ $produto->peso ?? old('peso') }}" placeholder="Peso" class="borda-preta">
        {{ $errors->has('peso') ? $errors->first('peso') : '' }}

        <button type="submit" class="borda-preta">Cadastrar</button>
    </form>
