// External Dependencies
import React, { Component, Fragment } from 'react';

// Internal Dependencies
import './style.css';


class SimpleHeader extends Component {

  static slug = 'simp_simple_header';

  render() {
    const Content = this.props.content;

    //console.log(this.props);

    return (
      <Fragment>
        <h1 className="simp-simple-header-heading">{this.props.heading}</h1>
          {/*this.props.content()*/}
          <Content />
      </Fragment>
    );
  }
}

export default SimpleHeader;