const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

registerBlockType( 'wp-recipe-maker/recipe', {
    title: __( 'Recipe' ),
    icon: 'media-document',
    keywords: [ 'wprm' ],
    category: 'formatting',
    transforms: {
        from: [
            {
                type: 'shortcode',
                tag: 'wprm-recipe',
                attributes: {
                    id: {
                        type: 'number',
                        shortcode: ( { named: { id = '' } } ) => {
                            return id.replace( 'id', '' );
                        },
                    },
                },
            },
        ]
    },
    attributes: {
        id: {
            type: 'number',
        },
    },
    edit: (props) => {
        const { attributes, className } = props;

        return <div className={ className }>Recipe { attributes.id }</div>
    },
    save: (props) => {
        return null;
    },
} );