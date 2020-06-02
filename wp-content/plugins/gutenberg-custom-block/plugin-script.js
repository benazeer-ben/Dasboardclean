import { registerBlockType } from '@wordpress/blocks';

const blockStyle = {
    backgroundColor: '#900',
    color: '#fff',
    padding: '20px',
};

registerBlockType( 'gutenberg-examples/example-01-basic-esnext', {
    title: 'Example: Basic (esnext)',
    icon: 'universal-access-alt',
    category: 'layout',
    example: {},