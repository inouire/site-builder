<?php
namespace Inanimatt\SiteBuilder\ContentHandler;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2012-04-21 at 00:59:50.
 */
class PhpFileContentHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PhpFileContentHandler
     */
    protected $object;
    
    protected $expectedContent = '
<h1>Hello World</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>';


    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new PhpFileContentHandler(__DIR__.'/../../../resources/subdir/example.php', 'subdir', 'subdir/example.php' );
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Inanimatt\SiteBuilder\ContentHandler\PhpFileContentHandler::__construct
     */
    public function testConstructor()
    {
        try {
            $object = new PhpFileContentHandler(__DIR__.'/non-existent file', 'subdir', 'subdir/example.php' );
            $this->fail('->__construct() throws a SiteBuilderException if the file does not exist');
        } catch(\Exception $e) {
            $this->assertInstanceOf('Inanimatt\SiteBuilder\SiteBuilderException', $e, '->__construct() throws a SiteBuilderException if the file does not exist');
            $this->assertEquals('File not found.', $e->getMessage(), '->__construct() throws a SiteBuilderException if the file does not exist');
        }
    }

    /**
     * @covers Inanimatt\SiteBuilder\ContentHandler\PhpFileContentHandler::getName
     */
    public function testGetName()
    {
        $this->assertEquals($this->object->getName(), 'subdir/example.php');
    }

    /**
     * @covers Inanimatt\SiteBuilder\ContentHandler\PhpFileContentHandler::getContent
     * @covers Inanimatt\SiteBuilder\ContentHandler\PhpFileContentHandler::__construct
     */
    public function testGetContent()
    {

        $this->assertEquals($this->expectedContent, $this->object->getContent());
    }

    /**
     * @covers Inanimatt\SiteBuilder\ContentHandler\PhpFileContentHandler::getMetadata
     * @covers Inanimatt\SiteBuilder\ContentHandler\PhpFileContentHandler::__construct
     */
    public function testGetMetadata()
    {
        $this->assertTrue(is_array($this->object->getMetadata()), '->getMetadata() returns array.');
        $this->assertArrayHasKey('title', $this->object->getMetadata(), '->getMetadata() has title variable.');
        $this->assertArrayHasKey('content', $this->object->getMetadata(), '->getMetadata() has content variable.');
        $m = $this->object->getMetadata();
        $this->assertEquals($this->expectedContent, $m['content'], '->getMetadata() content var contains content');
        $this->assertEquals('Hello World & Stuff', $m['title'], '->getMetadata() title var contains title');
        
    }
}
