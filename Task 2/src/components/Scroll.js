import React from 'react';

const Scroll = (props) => {
    return(
        //used to provide a scroll view
        <div style={{overflowY: 'hidden'}}>
            {props.children}
        </div>
    )
};

export default Scroll;
