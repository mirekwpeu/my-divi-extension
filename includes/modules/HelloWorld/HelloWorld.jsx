// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';


class HelloWorld extends Component {

  static slug = 'myex_hello_world';

  render() {
    const Content = this.props.content;

    //console.log(this.props);

    return (
      <h1>
        <Content />
      </h1>
    );
  }
}

export default HelloWorld;
