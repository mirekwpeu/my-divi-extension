// External Dependencies
import React, { Component, Fragment } from 'react';
//import parse from 'html-react-parser' //https://stackoverflow.com/questions/39758136/how-to-render-html-string-as-real-html //https://www.npmjs.com/package/react-html-parser

// Internal Dependencies
import './style.css';


class PostsLoop extends Component {

    static slug = 'posts-loop';

    render() {
        const
            content = this.props.__all_terms,
            contentJsonTxt = JSON.stringify(content, null, 2);

        if (content) {
            //https://www.pluralsight.com/resources/blog/guides/return-html-elements-in-json
            var listItems = Object.keys(content).map((key, i) => {
                const data = `<p style="margin-top: 1em; font-style: italic; padding-bottom: .2em">${key}:</p> ${content[key]}`;

                return (
                    <span key={i} dangerouslySetInnerHTML={{ __html: data }}></span>
                )
            })
        }

        return (
            <Fragment>
                <h1 className="posts-loop-header">{this.props.heading}</h1>
                <pre>{contentJsonTxt}</pre>
                {listItems ? (<div>
                    {
                        listItems
                    }
                </div>) : null}
            </Fragment>
        );
    }
}

export default PostsLoop;
