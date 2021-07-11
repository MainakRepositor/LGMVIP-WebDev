import React from 'react';
import './search.css';

const SearchBox=({searchfeild, searchChange})=>{
    return(
            <div className='pa3'>
                <input 
                className='pa2 ba'
                 type="search" id='sear'
                 placeholder='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Search User' 
                 onChange={searchChange}/>
            </div>
        );
}

export default SearchBox;
