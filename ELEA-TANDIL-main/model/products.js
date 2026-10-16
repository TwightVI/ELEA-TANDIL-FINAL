export const categories = [
    { name: 'Vinilo de corte', description: 'Para tus diseños y cartelería', filter: 'vinilo' },
    { name: 'Para vidrios', description: 'Privacidad y estilo', filter: 'vidrio' },
    { name: 'Textil', description: 'Personalizá cada prenda', filter: 'textil' },
    { name: 'Herramientas', description: 'El complemento perfecto', filter: 'herramienta' }
];

export async function getProducts() {
    const response = await fetch('/api/products');
    if (!response.ok) throw new Error('No se pudo cargar la base de datos');
    return response.json();
}