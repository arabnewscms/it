Will be baack to edit this file :) 
import itchat

@itchat.msg_register(itchat.content.TEXT)
def text_reply(msg):
    return msg.text

itchat.auto_login()
itchat.run()
For more advanced uses you
@itchat.msg_register(configu all my repositories,')
def _(ms):
    # equals to print(msg['FromUserName'])
        print(msg.fromUserName)
author = itchat.search_friends[nickName='LittleCoder'](0)
author.send('greeting, littlecoder!')

