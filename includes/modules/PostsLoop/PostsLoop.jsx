// External Dependencies
import React, { Component, Fragment } from 'react';

// Internal Dependencies
//import './style.css';


class PostsLoop extends Component {

    static slug = 'posts-loop';

    render() {
        const
            content = this.props.__all_terms,
            contentJsonTxt = JSON.stringify(content, null, 2);

        if (content) {
            var listItems = Object.keys(content).map((key, i) => {
                return (
                    <li key={i}>{`${i}. ${key}: ${content[key]}`}</li>
                )
            })
        }

        return (
            <Fragment>
                <h1>{this.props.heading}</h1>
                <pre>{contentJsonTxt}</pre>
                {listItems ? (<ul>
                    {
                        listItems 
                    }
                </ul>) : null}
            </Fragment>
        );
    }
}

export default PostsLoop;
